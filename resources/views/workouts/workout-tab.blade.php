
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <p class="font-bold">{{$workout->title}}</p>
                @if(auth()->id() == $workout->created_by_user_id)
                    <div class="float-right">
                <a class="text-blue-500" href="/workouts/edit/{{$workout->id}}">Edit Me</a>
                    </div>
                @endif
                <p>{{shorten_description($workout->description)}}...</p>
                <br>
                <x-imbeded-video :src="$workout->url" :width="560" :height="350" :frameborder="0">
                </x-imbeded-video>
            </div>
        </div>
    </div>
</div>
