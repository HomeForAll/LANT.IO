<?php

class UploadModel extends Model
{
    public function uploadImage()
    {
        if (!isset($_FILES['file'])) {
            $this->error(self::NO_FILE_ERROR);
        }

        $file_name = sha1(time() . mt_rand(1, 100));
        $query = $this->db->prepare('INSERT INTO ads_images (original, s_250_140, s_500_280, s_360_230, s_720_460, ad_id) VALUES (:original, :250_140, :500_280, :360_230, :720_460, 0) RETURNING id');

        $response = [];
        $handle = new upload($_FILES['file']);

        if (!$handle->uploaded) {
            $this->error(self::FILE_NOT_UPLOADED_ERROR);
        }

        if (!$handle->file_is_image) {
            $this->error(self::NOT_IMAGE_ERROR);
        }

        $directory_pattern = 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $file_name[0] . DIRECTORY_SEPARATOR . $file_name[0] . $file_name[1] . DIRECTORY_SEPARATOR . '{width_size}' . DIRECTORY_SEPARATOR;

        // Загружаем оригинал
        $handle->file_new_name_body = $file_name;
        $upload_directory = str_replace('{width_size}', 'original', $directory_pattern);
        $handle->Process(ROOT_DIR . $upload_directory);

        $response['original'] = DIRECTORY_SEPARATOR . $upload_directory . $handle->file_dst_name;

        // Рсайзим и загружаем 720x460
        $handle->image_resize = true;
        $handle->image_ratio_crop = true;
        $handle->image_x = 720;
        $handle->image_y = 460;
        $handle->file_new_name_body = $file_name;
        $upload_directory = str_replace('{width_size}', '720_460', $directory_pattern);
        $handle->Process(ROOT_DIR . $upload_directory);

        if (!$handle->processed) {
            $this->error(self::FILE_NOT_PROCESSED_ERROR, $handle->error);
        }

        $response['720_460'] = DIRECTORY_SEPARATOR . $upload_directory . $handle->file_dst_name;

        // Рсайзим и загружаем 500x280
        $handle->image_resize = true;
        $handle->image_ratio_crop = true;
        $handle->image_x = 500;
        $handle->image_y = 280;
        $handle->file_new_name_body = $file_name;
        $upload_directory = str_replace('{width_size}', '500_280', $directory_pattern);
        $handle->Process(ROOT_DIR . $upload_directory);

        if (!$handle->processed) {
            $this->error(self::FILE_NOT_PROCESSED_ERROR, $handle->error);
        }

        $response['500_280'] = DIRECTORY_SEPARATOR . $upload_directory . $handle->file_dst_name;

        // Рсайзим и загружаем 360x230
        $handle->image_resize = true;
        $handle->image_ratio_crop = true;
        $handle->image_x = 360;
        $handle->image_y = 230;
        $handle->file_new_name_body = $file_name;
        $upload_directory = str_replace('{width_size}', '360_230', $directory_pattern);
        $handle->Process(ROOT_DIR . $upload_directory);

        if (!$handle->processed) {
            $this->error(self::FILE_NOT_PROCESSED_ERROR, $handle->error);
        }

        $response['360_230'] = DIRECTORY_SEPARATOR . $upload_directory . $handle->file_dst_name;

        // Рсайзим и загружаем 250_140
        $handle->image_resize = true;
        $handle->image_ratio_crop = true;
        $handle->image_x = 250;
        $handle->image_y = 140;
        $handle->file_new_name_body = $file_name;
        $upload_directory = str_replace('{width_size}', '250_140', $directory_pattern);
        $handle->Process(ROOT_DIR . $upload_directory);

        if (!$handle->processed) {
            $this->error(self::FILE_NOT_PROCESSED_ERROR, $handle->error);
        }

        $response['250_140'] = DIRECTORY_SEPARATOR . $upload_directory . $handle->file_dst_name;

        $handle->clean();

        $query->execute(
            [
                ':original' => $response['original'],
                ':250_140'  => $response['250_140'],
                ':500_280'  => $response['500_280'],
                ':360_230'  => $response['360_230'],
                ':720_460'  => $response['720_460'],
            ]
        );

        if ($query->errorCode() !== '00000') {
            $this->error(self::DB_INSERT_ERROR, $query->errorInfo());
        }

        $image = $query->fetch();
        $response['id'] = $image['id'];
        $this->response($response);
    }

    public function uploadAvatar()
    {
        if (!isset($_FILES['file'])) {
            $this->error(self::NO_FILE_ERROR);
        }

        if (!isset($_SESSION['user'])) {
            $this->error(self::USER_NOT_AUTHORIZED_ERROR);
        }

        $response = [];
        $file_name = sha1(time() . mt_rand(1, 100));

        $query = $this->db->prepare('UPDATE users SET avatar_original = :avatar_original, avatar_50 = :avatar_50, avatar_100 = :avatar_100 WHERE id = :user_id');

        $handle = new upload($_FILES['file']);

        if (!$handle->uploaded) {
            $this->error(self::FILE_NOT_UPLOADED_ERROR, $handle->error);
        }

        if (!$handle->file_is_image) {
            $this->error(self::NOT_IMAGE_ERROR);
        }

        $directory_pattern = 'uploads' . DIRECTORY_SEPARATOR . 'avatars' . DIRECTORY_SEPARATOR . $file_name[0] . DIRECTORY_SEPARATOR . $file_name[0] . $file_name[1] . DIRECTORY_SEPARATOR . '{size}' . DIRECTORY_SEPARATOR;

        // Загружаем оригинал
        $handle->file_new_name_body = $file_name;
        $upload_directory = str_replace('{size}', 'original', $directory_pattern);
        $handle->Process(ROOT_DIR . $upload_directory);

        if (!$handle->processed) {
            $this->error(self::FILE_NOT_PROCESSED_ERROR, $handle->error);
        }

        $response['original'] = DIRECTORY_SEPARATOR . $upload_directory . $handle->file_dst_name;

        // Рсайзим и загружаем 50x50
        $handle->image_resize = true;
        $handle->image_ratio_crop = true;
        $handle->image_x = 50;
        $handle->image_y = 50;
        $handle->file_new_name_body = $file_name;
        $upload_directory = str_replace('{size}', '50_50', $directory_pattern);

        if (!$handle->processed) {
            $this->error(self::FILE_NOT_PROCESSED_ERROR, $handle->error);
        }

        $handle->Process(ROOT_DIR . $upload_directory);
        $response['50_50'] = DIRECTORY_SEPARATOR . $upload_directory . $handle->file_dst_name;

        // Рсайзим и загружаем 100x100
        $handle->image_resize = true;
        $handle->image_ratio_crop = true;
        $handle->image_x = 100;
        $handle->image_y = 100;
        $handle->file_new_name_body = $file_name;
        $upload_directory = str_replace('{size}', '100_100', $directory_pattern);
        $handle->Process(ROOT_DIR . $upload_directory);

        if (!$handle->processed) {
            $this->error(self::FILE_NOT_PROCESSED_ERROR, $handle->error);
        }

        $response['100_100'] = DIRECTORY_SEPARATOR . $upload_directory . $handle->file_dst_name;

        $response['original'] = str_replace("\\", "/", $response['original']);
        $response['50_50'] = str_replace("\\", "/", $response['50_50']);
        $response['100_100'] = str_replace("\\", "/", $response['100_100']);

        $handle->clean();

        $query->execute(
            [
                ':avatar_original' => $response['original'],
                ':avatar_50'       => $response['50_50'],
                ':avatar_100'      => $response['100_100'],
                ':user_id'         => $_SESSION['user']['id'],
            ]
        );

        if ($query->errorCode() !== '00000') {
            $this->error(self::DB_INSERT_ERROR, $query->errorInfo());
        }

        $this->response($response);
    }
}