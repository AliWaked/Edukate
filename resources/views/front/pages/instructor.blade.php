<x-front.layout> 
   <x-front.partials.header title='Instructors' :breadcrumb="['Home','Instructors']" :coursesNames="$coursesNames" />
   <x-front.partials.instructor :instructors="$instructors" />
</x-front.layout>