<style>
    .answer_true {
        background: cornflowerblue;
    }
</style>
<div class="dialogInfo">
    <h1>Вопрос: <?php echo $this->data['ticket'][0]['question']; ?></h1>
    <?php
    if (!empty($this->data['ticket'][0]['answerer_user_name'])) {
        ?>
        <div class="box">
            Контактное лицо службы поддержки:
            <div class="answerer_name">
                <?php echo $this->data['ticket'][0]['answerer_user_name']; ?>
            </div>
        </div>
    <?php } ?>
</div>
<div class="dialog">
    <div class="dialog_msg">
        <div class="dialog_msg_date"><?php echo $this->data['ticket'][0]['create_date_time']; ?></div>
        <div class="dialog_msg_name"><?php echo $this->data['ticket'][0]['user_name']; ?></div>
        <?php echo $this->data['ticket'][0]['description']; ?>
    </div>
    <?php
    foreach ($this->data['messages'] as $message) {
        ?>
        <div class="dialog_msg <?php //if ($message['status'] == true) echo 'answer_true' ?>">

            <?php if ($message['status'] == true) echo '<span style="color: red; font-size: 30px">L</span>
<span style="color: orange; font-size: 30px">A</span>
<span style="color: yellow; font-size: 30px">N</span>
<span style="color: green; font-size: 30px">T</span>
<span style="color: cyan; font-size: 30px">.</span>
<span style="color: blue; font-size: 30px">I</span>
<span style="color: purple; font-size: 30px">O</span>' ?>
            <div class="dialog_msg_date"><?php echo $message['answer_date']; ?></div>
            <div class="dialog_msg_name"><?php echo $message['answerer_user_name']; ?></div>
            <?php echo $message['answer']; ?>
        </div>
        <?php
    }
    ?>
</div>
<form action="" method="post">
    <textarea name="msg" id="msg" rows="10" placeholder="Сообщение ..."></textarea>
    <input type="submit" name="submit">
</form>