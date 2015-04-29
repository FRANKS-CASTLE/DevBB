<?php

/*
 * The MIT License
 *
 * Copyright 2015 CreepPlaysYT.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

require_once 'db.php';

if (isset($_POST["email"]) && isset($_POST["user"]) && isset($_POST["pass"])) {
    $userexists = false;
    if ($s = $mysqli->prepare("SELECT username FROM users WHERE username = ?")) {
        $s->bind_param("s", $_POST["user"]);
        $s->execute();
        $s->store_result();
        echo $s->num_rows;
        if($s->num_rows > 0) {
            $userexists = true;
        }
        $s->close();
    }
    
    if ($userexists == false) {
        if ($stmt = $mysqli->prepare("INSERT INTO users (username, email, password, online)"
                . "VALUES (?, ?, ?, 0)")) {
            $stmt->bind_param("sss", $_POST["user"], hash("sha256", $_POST["email"]), hash("sha256", $_POST["pass"]));
            $stmt->execute();
            echo "Datensätze verändert: " . $stmt->affected_rows;
            $stmt->close();
        } else {
            echo $mysqli->error;
        }
    } else {
        echo "Der Benutzer existiert schon";
    }
} else {
    echo "Unerlaubter Zugriff oder Wert nicht eingetragen!";
}

$mysqli->close();
