<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $proposals = [
            [
                'judul' => 'AI Academic Advisor',
                'deskripsi' => 'An Agentic AI system that analyzes student academic performance and recommends courses based on grades, prerequisites, and learning goals.',
            ],
            [
                'judul' => 'Smart Campus Assistant',
                'deskripsi' => 'An AI agent that answers campus-related questions, retrieves academic information, and guides students through administrative procedures.',
            ],
            [
                'judul' => 'Automated Research Assistant',
                'deskripsi' => 'An AI agent that organizes research references, summarizes scientific papers, and identifies relevant academic literature.',
            ],
            [
                'judul' => 'Intelligent Course Planner',
                'deskripsi' => 'An AI agent that helps students plan their semester based on course prerequisites, credit limits, and academic priorities.',
            ],
            [
                'judul' => 'Automated Code Review Agent',
                'deskripsi' => 'An AI agent that reviews programming assignments, identifies potential bugs, and explains possible code improvements.',
            ],
            [
                'judul' => 'Student Support Agent',
                'deskripsi' => 'An AI agent that classifies student inquiries, retrieves relevant university information, and recommends appropriate solutions.',
            ],
        ];

        $proposal = fake()->randomElement($proposals);

        return [
            'judul' => $proposal['judul'],
            'deskripsi' => $proposal['deskripsi'],
            'tema_agent' => 'Ollama',
            'api_key_secure' => fake()->sha256(),
            'user_id' => null,
        ];
    }
}
