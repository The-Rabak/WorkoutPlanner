
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <x-basic-link :href="$category->getRoute()" class="font-bold">{{$category->title}}</x-basic-link>
                @if(auth()->id() == $category->created_by_user_id)
                    <div class="float-right">
                        <a class="text-blue-500" href="/categories/edit/{{$category->slug}}">Edit Me</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
