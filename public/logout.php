<?php
session_start();
// УДАЛЯЕМ СЕССИЮ
unset($_SESSION['login']);
header("Location: /");
