<?php

function valMsg($errors, $field)
{
    if ($errors->has($field)) {
        return "<span class='invalid-feedback'>
                    <strong> " . $errors->first($field) . " </strong>
                 </span>
               ";
    }
}

function getValClass($errors, $field)
{
    return $errors->has($field) ? "is-invalid" : "";
}