<?php

namespace Reviews\Interfaces;

interface ReviewFormInterface {

    public function render();
    public function handleSubmitEvent();
    
}