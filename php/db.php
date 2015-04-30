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

include_once '../config/config.inc.php';
$mysqli = new mysqli(dbhost, username, password, database);

if($mysqli->connect_error) {
    echo "Fehler bei der Verbindung: " . mysqli_connect_error();
    exit();
}

$mysqli->query("CREATE TABLE IF NOT EXISTS `users` (`username` varchar(30) NOT NULL,`email` tinytext NOT NULL,".
"  `password` tinytext NOT NULL, `online` int(11) NOT NULL" .
") ENGINE=InnoDB DEFAULT CHARSET=latin1;");

//$mysqli->close();
