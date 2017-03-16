<style>
    .title {
        margin-bottom: 15px;
        font-family: Arial, sans-serif;
        font-size: 18pt;
        font-weight: bold;
    }

    form {
        margin-bottom: 15px;
    }

    input[type=text] {
        font-family: Arial, sans-serif;
        font-size: 10pt;
        width: 100%;
        box-sizing: border-box;
        padding: 10px 15px 10px 15px;
        margin-bottom: 15px;
        border: solid 1px gray;
        border-radius: 3px;
    }

    input[type=submit] {
        margin-top: 15px;
        width: 200px;
    }

    #description {
        padding: 10px 15px 10px 15px;
        width: 100%;
        box-sizing: border-box;
        resize: vertical;
        border-radius: 3px;
        border: solid 1px gray;
    }
</style>

<form action="" method="post">
    <div class="title">Обращение в тех. поддержку</div>
    <input type="text" name="question" placeholder="Вопрос или проблема ..." value="<?php echo isset($_POST['question']) ? $_POST['question'] : ''; ?>">
    <textarea name="description" id="description" rows="15" placeholder="Описание ..."></textarea>
    <input type="submit" name="submit" value="Отправить">
</form>

<script>
    document.getElementById('description').value = '<?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?>';
</script>
