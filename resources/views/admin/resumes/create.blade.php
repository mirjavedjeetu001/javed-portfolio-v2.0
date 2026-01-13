@extends('admin.layout')

@section('title', 'Upload Resume')
@section('page-title', 'Paste Resume Text')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Paste Resume / CV Text</h3>
            <p class="text-sm text-gray-600 mt-1">Copy all text from your resume and paste it below. AI will parse it automatically.</p>
        </div>
        
        <form action="{{ route('admin.resumes.store') }}" method="POST" class="p-6">
            @csrf
            
            <!-- Sample Format Section -->
            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-200 rounded-lg p-6 mb-6">
                <h4 class="text-sm font-semibold text-blue-800 mb-3 flex items-center">
                    <i class="fas fa-lightbulb mr-2"></i>Sample Resume Text Format
                </h4>
                <div class="bg-white rounded-lg p-4 font-mono text-xs text-gray-700 overflow-x-auto">
<pre class="whitespace-pre-wrap">JOHN DOE
Software Engineer | Full Stack Developer
Email: john.doe@example.com | Phone: +1-234-567-8900
LinkedIn: linkedin.com/in/johndoe | Portfolio: johndoe.com
Location: San Francisco, CA

PROFESSIONAL SUMMARY
Experienced software engineer with 5+ years building scalable web applications.
Expert in PHP, Laravel, JavaScript, and React. Passionate about clean code.

WORK EXPERIENCE

Senior Software Engineer | Tech Corp Inc.
January 2020 - Present | San Francisco, CA
• Developed and maintained 15+ web applications using Laravel and React
• Led a team of 5 developers in agile environment
• Improved application performance by 40% through optimization
• Implemented CI/CD pipelines and automated testing

Software Developer | Web Solutions Ltd.
June 2018 - December 2019 | New York, NY
• Built RESTful APIs and microservices architecture
• Collaborated with cross-functional teams
• Reduced bug rate by 30% through code reviews

EDUCATION

Bachelor of Science in Computer Science
University of California | 2014 - 2018
GPA: 3.8/4.0

SKILLS
Languages: PHP, JavaScript, Python, Java, SQL
Frameworks: Laravel, React, Vue.js, Node.js
Tools: Git, Docker, AWS, MySQL, PostgreSQL
Other: RESTful APIs, Agile, TDD, CI/CD

PROJECTS

E-commerce Platform
• Built full-stack e-commerce platform with Laravel and React
• Integrated payment gateways and inventory management
• 10,000+ active users

Portfolio Website Builder
• Developed SaaS platform for creating portfolio websites
• Implemented drag-and-drop interface
• 500+ paying customers

CERTIFICATIONS
AWS Certified Developer - Associate | Amazon Web Services | 2021
Laravel Certified Developer | Laravel | 2020</pre>
                </div>
                <p class="text-xs text-blue-700 mt-3">
                    <i class="fas fa-info-circle mr-1"></i>
                    Copy this format and replace with your own information. Keep section headings clear (EXPERIENCE, EDUCATION, SKILLS, etc.)
                </p>
            </div>

            <!-- Text Input Area -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Paste Your Resume Text
                    <span class="text-gray-500 font-normal">(Copy all text from your PDF and paste here)</span>
                </label>
                <textarea id="resume_text" name="resume_text" rows="20" required
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent font-mono text-sm"
                          placeholder="Paste your complete resume text here following the format shown above...">{{ old('resume_text') }}</textarea>
                @error('resume_text')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <h4 class="text-sm font-semibold text-blue-800 mb-2">
                    <i class="fas fa-robot mr-2"></i>How AI Parsing Works
                </h4>
                <ul class="text-sm text-blue-700 space-y-1">
                    <li>• AI will automatically extract personal info, experience, education, skills, and projects</li>
                    <li>• Make sure section headings are clear (EXPERIENCE, EDUCATION, SKILLS, etc.)</li>
                    <li>• Review the parsed data before applying it to your portfolio</li>
                    <li>• You can manually edit any section after applying</li>
                    <li>• Keep dates in standard format (e.g., January 2020 - Present)</li>
                </ul>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('admin.resumes.index') }}" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Resumes
                </a>
                <button type="submit" class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-6 py-3 rounded-lg transition duration-300 shadow-lg">
                    <i class="fas fa-magic mr-2"></i>Parse Resume with AI
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
