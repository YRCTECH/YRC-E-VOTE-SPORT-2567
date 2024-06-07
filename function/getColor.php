<?php

    // Get color tag
    function getNameColor() {
        $color = $_SESSION["t_color"];
        switch ($color) {
            case "yellow":
                echo "เทอดจรรยา (สีเหลือง)";
                break;
            case "green":
                echo "ศรีวัฒนา (สีเขียว)";
                break;
            case "red":
                echo "สามัคคี (สีแดง)";
                break;
            case "blue":
                echo "ภักดิ์พิรีย์ (สีฟ้า)";
                break;
            case "purple":
                echo "การุณรักษ์ (สีม่วง)";
                break;
        }
    }

    // Get color text
    function getColorText() {
        $color = $_SESSION["t_color"];
        switch ($color) {
            case "yellow":
                echo "#ffc107";
                break;
            case "green":
                echo "#198754";
                break;
            case "red":
                echo "#dc3545";
                break;
            case "blue":
                echo "#0d6efd";
                break;
            case "purple":
                echo "#7952b3";
                break;
        }
    }

    // Get color button
    function getColorBtn() {
        $color = $_SESSION["t_color"];
        switch ($color) {
            case "yellow":
                echo "btn-warning";
                break;
            case "green":
                echo "btn-success";
                break;
            case "red":
                echo "btn-danger";
                break;
            case "blue":
                echo "btn-primary";
                break;
            case "purple":
                echo "btn-purple";
                break;
        }
    }

