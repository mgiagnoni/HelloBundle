<?php

/**
 * Copyright 2011 Massimo Giagnoni <gimassimo@gmail.com>
 *
 * This source file is subject to the MIT license included
 * with this source code (Resources/meta/LICENSE).
 */

namespace FooApps\HelloBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;

class FriendForm extends Form
{
    public function configure()
    {
        $this->add(new TextField('name', array(
            'max_length' => 50,
        )));
    }
}
