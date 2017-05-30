<?php

// модель авторизации
class Auth_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function add() {
        $username = $_POST['login'];
        $passw = MD5($_POST['password']);
        $passwrep = MD5($_POST['passwordrep']);
        $fio = $_POST['fio'];
        if ($passw == $passwrep) {
            $ath = $this->db->prepare("SELECT id FROM users WHERE username = :un;");
            $ath->execute(array(
                ':un' => $username
            ));
            // проверим наличие пользователя с таким именем     
            $res = $ath->fetch(PDO::FETCH_ASSOC);
            $cnt = $res['id'];
            //echo $cnt;
            if ($cnt == 0) {
                $ath = $this->db->prepare("INSERT into users (username ,passw, fio) values ( :un, :pw, :fi);");
                $ath->execute(array(
                    ':un' => $username,
                    ':pw' => $passw,
                    ':fi' => $fio
                ));
                // echo "ddd";
            } else {
                header('Location: /err/adderror/alreadyexists');
                // есть уже такой, идем в контроллер ошибок
                return false;
            }
        } else {
            // echo "пароли не совпадают";
            header('Location: /err/adderror/password');
            return false;
        }
        // идем в index контроллер, хотя в норм проекте надо бы эту функцию в Auth перенести, но тогда непонятно зачем тут вообще index контроллер ))) а так отрабатывает успешние дейчтвия пользователя
        header('Location: /index/regsuccess');
    }

    public function change() {
        $newpass = $_POST['newpass'];
        $newpassrep = $_POST['newpassrep'];
        $userid = $_POST['userid'];
        if ($newpass == $newpassrep) {
            $ath = $this->db->prepare("SELECT Passw FROM users WHERE id = :ui");
            $ath->execute(array(
                ':ui' => $userid,
            ));
            $pas = $_POST['password'];
            $data = $ath->fetch(PDO::FETCH_ASSOC);
            if (MD5($pas) == $data['Passw']) {
                //  echo "все ок меняем запись";
                $username = $_POST['login'];
                $fio = $_POST['fio'];
                $pass = MD5($newpass);
                $ath = $this->db->prepare("UPDATE users SET username = :un, Passw = :pw, Fio = :fi WHERE id = $userid");
                $ath->execute(array(
                    ':un' => $username,
                    ':pw' => $pass,
                    ':fi' => $fio
                ));

                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['fio'] = $fio;
                session_write_close();
                header('Location: /index/changesuccess');
                return false;
            } else {
                header('Location: /err/adderror/wrongpassword');
                return false;
            }
        } else {
            header('Location: /err/adderror/password');
            return false;
        }
    }

    public function run() {
        $ath = $this->db->prepare("SELECT * FROM users WHERE username = :l AND passw = MD5(:p)");
        $ath->execute(array(
            ':l' => $_POST['login'],
            ':p' => $_POST['password']
        ));
        // echo "Логинимся";
        $data = $ath->fetch(PDO::FETCH_ASSOC);
        $u_id = $data['id'];
        if ($u_id > 0) {
            session_name('auth');
            session_start();
            $_SESSION['id'] = $u_id;
            $_SESSION['username'] = $data['username'];
            $_SESSION['fio'] = $data['Fio'];
            session_write_close();
            header('Location: ../index');
        } else {
            header('Location: ../err/errorlogin');
        }
    }

}

?>