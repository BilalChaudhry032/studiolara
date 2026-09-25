@props([
    'studies', // CaseStudy collection
    'lineByService', // service title => line key, to draw each study's bullets
])

{{-- Case studies as posters: a swipeable row on phones, a three-column wall from md up. --}}
<div {{ $attributes->merge(['class' => '-mx-5 flex snap-x snap-mandatory scroll-px-5 gap-5 overflow-x-auto px-5 pb-2 [scrollbar-width:none] sm:-mx-8 sm:scroll-px-8 sm:px-8 md:mx-0 md:grid md:grid-cols-3 md:gap-8 md:overflow-visible md:px-0']) }}>
    @foreach ($studies as $study)
        <x-poster
            class="w-[80%] shrink-0 snap-start sm:w-[55%] md:w-auto"
            :href="route('work.show', $study)"
            :title="$study->title"
            :subtitle="implode(' · ', $study->service_tags ?? [])"
            :lines="$study->linesFrom($lineByService)"
            :image="$study->getFirstMediaUrl('cover', 'medium') ?: null"
            :alt="'Product screens from the ' . $study->title . ' project'"
            :sample="$study->is_sample"
        />
    @endforeach
</div>
