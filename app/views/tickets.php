<a class='button' href='/cabinet'>Личный кабинет</a>

<?php
if (!empty($this->data)) {
    foreach ($this->data as $ticket) {
        ?>

        <div class="ticket<?php echo ($ticket['new_answer']) ? ' ticket_answer' : '';
        echo (!$ticket['status']) ? ' ticket_close' : ''; ?>">
            <div class="createDate"><?php echo $ticket['create_date_time']; ?></div>
            <div class="ticketName">
                Проблема: <?php echo $ticket['question']; ?>
            </div>
            <div class="ticketContent">
                Описание проблемы: <?php echo $ticket['description']; ?>
            </div>
            <?php
            if ($ticket['status']) {
                ?>
                <a class="button" href="/support/dialog/id/<?php echo $ticket['id']; ?>">Перейти к диалогу</a>
                <a class="button" href="/support/dialog/close/id/<?php echo $ticket['id']; ?>">Закрыть</a>
                <div class="ticketStatus">Открыт</div>
                <?php
            } else {
                ?>
                <div class="ticketStatus">Закрыт</div>
                <?php
            }
            if ($ticket['status'] && $ticket['new_answer']) {
                ?>
                <div class="answer_message">Получен ответ</div>
                <?php
            }
            ?>
        </div>
        <?php
    }
} else {
    echo '<h2>Обращения отсутствуют.</h2>';
}
?>