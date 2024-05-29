
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section'=>auth()->user()->name])
        </div>

            
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 relative">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-2">

                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-xl">Candidates for <span class="bg-slate-700 p-1 text-white">{{ $activeEvent->name }}</span></h1>
                    <span class="text-orange-500"><i class="fa-solid fa-calendar-clock"></i> On-going</span>
                </div>
                <div class="flex gap-4 shadow px-2">
                    @include('judge.indicator.steps', ['categories'=>$activeEvent->category])
                </div>
                <div class="bg-white rounded-md p-2 shadow-2 mt-4 flex flex-wrap gap-4">
                    {{-- {{ $activeEvent->candidates }} --}}
                    @foreach ($activeEvent->candidates as $key => $candidate)
                    
                        <div class="shadow group hover:cursor-pointer">
                            <div class="relative overflow-hidden">
                                <img class="w-30 h-30 transform transition-transform duration-300 ease-in-out group-hover:scale-110" 
                                    src="{{ asset('storage').'/'.$candidate->profile }}" alt="">
                                <span class="absolute top-1 left-1 bg-red-500 p-1 rounded-xl text-white font-bold text-sm">
                                    
                                    @if ($key < 10)
                                        0{{ $key+1 }}
                                    @else
                                        {{ $key }}
                                    @endif
                                </span>
                                @if (count($candidatesWithVotesInCategory) == 0)
                                    <a data-candidate_id="{{ $candidate->id }}" data-name="{{ $candidate->name }}" href="#" class="absolute voteNow w-fit h-fit tracking-wide top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-red-500 px-4 py-2 rounded-xl text-white font-bold text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">
                                        Vote
                                    </a>  
                                @endif
                               @foreach ($candidatesWithVotesInCategory as $voted)
                                   @if ($voted->id == $candidate->id)
                                        <a data-candidate_id="{{ $candidate->id }}" data-name="{{ $candidate->name }}" href="#" class="absolute w-fit h-fit tracking-wide top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-green-500 px-4 py-2 rounded-xl text-white font-bold text-sm opacity-100 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">
                                            Voted
                                        </a>
                                    @else
                                        <a data-candidate_id="{{ $candidate->id }}" data-name="{{ $candidate->name }}" href="#" class="absolute voteNow w-fit h-fit tracking-wide top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-red-500 px-4 py-2 rounded-xl text-white font-bold text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">
                                            Vote
                                        </a> 
                                   @endif
                               @endforeach
                                
                            </div>
                            <div class="flex flex-col max-w-30 text-center text-sm">
                                <span class="font-bold">{{ $candidate->name }}</span>
                                <span>Age: <b>{{ $candidate->age }}</b></span>
                            </div>
                        </div>
                    
                    @endforeach
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>

    @include('judge.vote.vote')
    @section('scripts')
        <script>
            $(document).ready(function(){
                let availablecategory = @json($eventCategory);
                let statusVote = @json(session('message'));
                
                // console.log(availablecategory)

                console.log(statusVote)
                if(statusVote !== null){
                    message(statusVote)
                }

                $('.voteNow').click(function(){
                    // alert($(this).data('name'))
                    $('#candidateName').text($(this).data('name'))
                    $('#categoryName').text(availablecategory.category_name)
                    // console.log($(this).data('candidate_id'))
                    $('#candidate_id').val($(this).data('candidate_id'))
                    $('#category_id').val(availablecategory.id)

                    render(availablecategory.sub_category)
                    $('#voteBackdrop').removeClass('hidden')
                    $('#voteModal').removeClass('hidden')
                })

                $('#voteCloseBtn').click(function(){
                    $('#voteBackdrop').addClass('hidden')
                    $('#voteModal').addClass('hidden')
                })
            })

            const render = (criteria) => {
                let renderCriteria = ''
                criteria.forEach(c => {
                    renderCriteria += `
                        <div class="flex justify-between items-center font-bold shadow mb-2 p-2">
                            <label for="criteria">${c.sub_category}: <span>- ${c.percentage}%</span></label>
                            <input type="number" name="criteria[]" value="" class="rounded-md" required>
                        </div>
                    `
                });

                $('#renderCriteriaContainer').html(renderCriteria)
            }

            const message = (message) => {
                Swal.fire({
                    title: "Vote Recorded!",
                    text: message,
                    icon: "success",
                    timer: 2000,  // Close after 2 seconds (2000 milliseconds)
                    showConfirmButton: false  // Hide the confirmation button
                });

            }
        </script>
    @endsection
</x-app-layout>


