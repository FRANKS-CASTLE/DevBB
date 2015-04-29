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

if (isset($_POST["user"]) && isset($_POST["pass"])) {
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
    
    if($userexists) {
        $password = hash("sha256", $_POST["pass"]);
        
        if($stmt = $mysqli->prepare("SELECT password FROM users WHERE username = ?")) {
            $stmt->bind_param("s", $_POST["user"]);
            $stmt->execute();
            $stmt->bind_result($pass);
            
            $stmt->fetch();
            if($pass == $password) {
                echo "OK";
            } else {
                echo "FALSE";
            }
        }
    } else {
        echo "Already exists";
    }
}