<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    // Get all categories
    public function getAllCategories()
    {
        return Category::all();
    }

    // Create a new category
    public function createCategory(array $data)
    {
        return Category::create($data);
    }

    // Update an existing category
    public function updateCategory(Category $category, array $data)
    {
        return $category->update($data);
    }

    // Delete a category
    public function deleteCategory(Category $category)
    {
        return $category->delete();
    }
}
