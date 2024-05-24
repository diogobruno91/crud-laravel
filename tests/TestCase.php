<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Database\Eloquent\Model;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function bootTraits(): void
    {
        parent::bootTraits();

        // Desativar soft delete globalmente para os testes
        Model::unsetEventDispatcher();
        Model::withoutTrashed();
    }
}
