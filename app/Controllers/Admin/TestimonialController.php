<?php

namespace App\Controllers\Admin;

use App\Models\TestimonialModel;

class TestimonialController extends SimpleCrudController
{
    protected string $viewPath    = 'admin/testimonials';
    protected string $redirectUrl = 'admin/testimonials';
    protected string $moduleTitle = 'Testimonial';
    protected string $auditModel  = 'Testimonial';
    protected array $searchFields = ['name'];
    protected array $fileFields   = ['photo'];

    public function __construct()
    {
        $this->model = new TestimonialModel();
    }
}
