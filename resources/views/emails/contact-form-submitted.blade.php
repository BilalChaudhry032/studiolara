<x-mail::message>
# New Project Inquiry

**Name:** {{ $submission->name }}
**Email:** {{ $submission->email }}
@if ($submission->company)
**Company:** {{ $submission->company }}
@endif
@if ($submission->project_type)
**Project Type:** {{ $submission->project_type }}
@endif
@if ($submission->budget_range)
**Budget Range:** {{ $submission->budget_range }}
@endif
@if ($submission->timeline)
**Timeline:** {{ $submission->timeline }}
@endif

**Project Description:**

{{ $submission->description }}

<x-mail::button :url="'mailto:' . $submission->email">
Reply to {{ $submission->name }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }} — Contact Form
</x-mail::message>
