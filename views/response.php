<?php

    header('Content-Type: application/json');

    if (isset($posts)) {
        echo json_encode($posts);
    } elseif (isset($post)) {
        echo json_encode($post);
    } else { 
        echo json_encode(['message' => 'No content']);
    }

