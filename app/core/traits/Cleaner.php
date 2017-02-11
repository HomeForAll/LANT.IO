<?php

trait Cleaner {
    private function clearOAuth() {
        unset($_SESSION['OAuth_user_id']);
        unset($_SESSION['OAuth_avatar']);
        unset($_SESSION['OAuth_first_name']);
        unset($_SESSION['OAuth_last_name']);
        unset($_SESSION['OAuth_service']);
        unset($_SESSION['OAuth_state']);
    }
}