<?php

namespace Tests\Feature;

use app\Services\TodoListService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class TodoListServiceTest extends TestCase
{
    private TodoListService $todoListService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->todoListService = $this->app->make(TodoListService::class);
    }

    public function testTodoLisetNotNull()
    {
        self::assertNotNull($this->todoListService);
    }

    public function testSaveTodo()
    {
        $this->todoListService->saveTodo('1', 'Prama');

        $todolist = Session::get('todolist');
        foreach ($todolist as $value){
            self::assertEquals('1', $value['id']);
            self::assertEquals('Prama', $value['todo']);
        }
    }

    public function testGetTodolistEmpty()
    {
        self::assertEquals([], $this->todoListService->getTodoList());
    }

    public function testGetTodolistNotEmpty()
    {
        $expected = [
            [
                'id' => '1',
                'todo' => 'Prama'
            ],
            [
                'id' => '2',
                'todo' => 'Yuda'
            ]
        ];

        $this->todoListService->saveTodo('1', 'Prama');
        $this->todoListService->saveTodo('2', 'Yuda');

        self::assertEquals($expected, $this->todoListService->getTodoList());
    }
}
