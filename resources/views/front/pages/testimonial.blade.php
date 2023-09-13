<x-front.layout>

    <!-- Header Start -->
    <x-front.partials.header title='Testimonial' :breadcrumb="['Home','Testimonial']" :coursesNames="$coursesNames" />
    <!-- Header End -->
    {{-- Testimonial Start --}}
    <x-front.partials.testimonial :testimonials="$testimonials" />
    {{-- Testimonial End --}}
</x-front.layout>
