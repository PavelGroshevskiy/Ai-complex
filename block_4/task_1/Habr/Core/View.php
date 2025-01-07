<?php

namespace Core;

class View
{
    public function generate($template_view)
    {
        include 'Views/' . $template_view;
    }
}