<x-front.layout title='About As'>

    <!-- Header Start -->
   <x-front.partials.header title="{{__('About')}}" :breadcrumb="[__('Home'),__('About')]" :coursesNames="$coursesNames" />
    <!-- Header End -->
    
    {{-- start about --}}
    <x-front.partials.about 
                            title='About'
                            :breadcrumb="['Home','about']"
                            :numberOfCategories="$numberOfCategories"
                            :numberOfCourses="$numberOfCourses"
                            :numberOfInstructors="$numberOfInstructors"
                            :numberOfStudent="$numberOfStudent"
/>
    {{-- end about --}}
    
    {{-- start feature  --}}
        <x-front.partials.feature />
    {{-- end feature  --}}
    
</x-front.layout>
