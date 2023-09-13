<x-front.layout>
    <x-front.partials.header title='Features' :breadcrumb="['Home', 'Features']" :coursesNames="\App\Models\Course::where('status', 'acceptable')->get()->pluck('name')" />
    <x-front.partials.feature />
</x-front.layout>
