<?php

namespace App\Http\Controllers;

use App\Factories\PostFactoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postFactory;

    public function __construct(PostFactoryInterface $postFactory)
    {
        $this->postFactory = $postFactory;
    }

    public function index()
    {
        $posts = $this->postFactory->all();
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post = $this->postFactory->create($validated);
        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = $this->postFactory->find($id);
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post = $this->postFactory->update($id, $validated);
        return response()->json($post);
    }

    public function destroy($id)
    {
        $this->postFactory->delete($id);
        return "Se eliminó el ID: $id";    }
}
