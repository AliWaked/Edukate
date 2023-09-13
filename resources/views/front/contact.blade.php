<x-front.layout title="contact">
    <!-- Header Start -->
   <x-front.partials.header title="{{__('Contact')}}" :breadcrumb="[__('Home'),__('contact')]" :coursesNames="$coursesNames" />
    
    <!-- Header End -->
    <!-- Contact Start -->
    <x-front.partials.contact />
    <!-- Contact End -->
</x-front.layout>
