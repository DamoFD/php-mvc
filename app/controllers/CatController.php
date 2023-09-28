<?php

class CatController extends Controller
{
    private object $cat;

    public function __construct()
    {
        $this->cat = $this->model('Cat');
    }

    public function index(): void
    {
        $cats = $this->cat->all();

        $this->view('cat/index', $cats);
    }

    public function show(int $id): void
    {
        $cat = $this->cat->find($id);

        if (!$cat) {
            http_response_code(404);
            exit;
        }

        $this->view('cat/show', $cat);
    }

    public function create(): void
    {
        $this->view('cat/create');
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(403);
            echo "403 Forbidden: You can only access this endpoint using POST method.";
            exit;
        }

        $name = filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW);
        $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);

        if ($name && $age) {
            $data = ['name' => $name, 'age' => $age];
            $types = 'si';
            $this->cat->store($data, $types);
            header('Location: /public/cat/index');
            exit;
        } else {
            http_response_code(400);
            echo "400 Bad Request: Invalid input.";
        }
    }

    public function edit(int $id): void
    {
        $cat = $this->cat->find($id);

        if (!$cat) {
            http_response_code(404, 'Not Found');
            exit;
        }

        $this->view('cat/edit', $cat);
    }

    public function update(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(403);
            echo "403 Forbidden: You can only access this endpoint using POST method.";
            exit;
        }

        $name = filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW);
        $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);

        if ($name && $age) {
            $data = ['name' => $name, 'age' => $age];
            $types = 'si';
            $this->cat->update($id, $data, $types);
            header("Location: /public/cat/show/{$id}");
            exit;
        } else {
            http_response_code(400);
            echo "400 Bad Request: Invalid input.";
        }
    }
}
