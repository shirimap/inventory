<?php

function showSuccessMessage($message, $title)
{
    echo "<script>
        toastr.success('$message', '$title');
    </script>";
}

function showErrorMessage($message, $title)
{
    echo "<script>
        toastr.error('$message', '$title');
    </script>";
}

function showWarningMessage($message, $title)
{
    echo "<script>
        toastr.warning('$message', '$title');
    </script>";
}
