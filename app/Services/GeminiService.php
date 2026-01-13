<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected $apiKey;
    protected $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent';

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
    }

    /**
     * Parse resume PDF/text and extract structured data
     */
    public function parseResume(string $resumeText): ?array
    {
        $prompt = $this->buildResumeParsingPrompt($resumeText);
        
        try {
            $response = Http::timeout(120)->post($this->apiUrl . '?key=' . $this->apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.1,
                    'topK' => 40,
                    'topP' => 0.95,
                    'maxOutputTokens' => 8192,
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                
                if (!isset($result['candidates'][0]['content']['parts'][0]['text'])) {
                    Log::error('Gemini API Response Missing Text: ' . json_encode($result));
                    throw new \Exception('Invalid response structure from Gemini API');
                }
                
                $text = $result['candidates'][0]['content']['parts'][0]['text'];
                
                // Extract JSON from markdown code blocks if present
                $text = $this->extractJson($text);
                
                $decoded = json_decode($text, true);
                
                if (json_last_error() !== JSON_ERROR_NONE) {
                    Log::error('JSON Decode Error: ' . json_last_error_msg() . ' | Text: ' . $text);
                    throw new \Exception('Failed to parse JSON response');
                }
                
                return $decoded;
            }

            $errorBody = $response->body();
            Log::error('Gemini API Error (Status: ' . $response->status() . '): ' . $errorBody);
            throw new \Exception('Gemini API request failed: ' . $errorBody);

        } catch (\Exception $e) {
            Log::error('Gemini Service Exception: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Build prompt for resume parsing
     */
    protected function buildResumeParsingPrompt(string $resumeText): string
    {
        return <<<PROMPT
You are an AI assistant specialized in parsing resumes and extracting structured data. 
Analyze the following resume text and extract all relevant information into a structured JSON format.

Resume Text:
$resumeText

Please extract and return ONLY a valid JSON object (no markdown, no code blocks) with the following structure:

{
  "personal_info": {
    "name": "",
    "title": "",
    "email": "",
    "phone": "",
    "address": "",
    "bio": ""
  },
  "statistics": {
    "years_experience": 0,
    "projects_completed": 0,
    "technologies_used": 0,
    "countries_visited": 0
  },
  "experiences": [
    {
      "position": "",
      "company": "",
      "location": "",
      "start_date": "YYYY-MM-DD",
      "end_date": "YYYY-MM-DD or null",
      "is_current": false,
      "description": ""
    }
  ],
  "education": [
    {
      "degree": "",
      "institution": "",
      "location": "",
      "start_date": "YYYY-MM-DD",
      "end_date": "YYYY-MM-DD",
      "grade": "",
      "description": ""
    }
  ],
  "skills": [
    {
      "category": "",
      "skills": [
        {"name": "", "percentage": 0}
      ]
    }
  ],
  "projects": [
    {
      "title": "",
      "description": "",
      "url": "",
      "technologies": [],
      "tags": []
    }
  ],
  "certifications": [
    {
      "name": "",
      "organization": "",
      "issue_date": "YYYY-MM-DD",
      "credential_id": "",
      "credential_url": "",
      "description": ""
    }
  ]
}

Important: Return ONLY the JSON object, no additional text or explanation.
PROMPT;
    }

    /**
     * Extract JSON from markdown code blocks
     */
    protected function extractJson(string $text): string
    {
        // Remove markdown code blocks
        $text = preg_replace('/```json\s*/', '', $text);
        $text = preg_replace('/```\s*/', '', $text);
        $text = trim($text);
        
        return $text;
    }

    /**
     * Generate content suggestions for portfolio sections
     */
    public function generateContentSuggestion(string $section, array $existingData = []): ?string
    {
        $prompt = "You are a professional portfolio content writer. Generate compelling content for the '$section' section of a portfolio website. ";
        
        if (!empty($existingData)) {
            $prompt .= "Here is the existing data: " . json_encode($existingData);
        }
        
        $prompt .= "\n\nProvide a well-written, professional description (2-3 paragraphs, around 150-200 words).";

        try {
            $response = Http::timeout(30)->post($this->apiUrl . '?key=' . $this->apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                return $result['candidates'][0]['content']['parts'][0]['text'] ?? null;
            }

            return null;

        } catch (\Exception $e) {
            Log::error('Gemini Content Generation Error: ' . $e->getMessage());
            return null;
        }
    }
}
