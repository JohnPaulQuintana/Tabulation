
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
                <div class="p-1">
                    <p><span class="text-red-500">Note: </span>All the Candidate's are required to have a vote. just click their profile to start voting...</p>
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
                                @php
                                    $alreadyVoted = [];
                                @endphp
                                @foreach ($candidatesWithVotesInCategory as $voted)
                                {{-- {{ $voted->votes }} --}}
                                    @if ($voted->id == $candidate->id)
                                        <a data-vote_id="{{ $voted->votes[0]->id }}" data-name="{{ $candidate->name }}" href="#" class="editVote absolute w-fit h-fit tracking-wide top-1 right-1 transform bg-green-500 px-1 py-1 rounded-md text-white font-bold text-sm opacity-100 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a data-candidate_id="{{ $candidate->id }}" data-name="{{ $candidate->name }}" href="#" class="absolute w-fit h-fit tracking-wide top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-green-500 px-4 py-2 rounded-xl text-white font-bold text-sm opacity-60 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">
                                            Voted
                                        </a>
                                        @php 
                                            $alreadyVoted[] = $candidate->id;
                                        @endphp
                                        @break
                                    @endif
                                @endforeach
                            
                                @if (!in_array($candidate->id, $alreadyVoted))
                                    <a data-candidate_id="{{ $candidate->id }}" data-name="{{ $candidate->name }}" href="#" class="absolute voteNow w-fit h-fit tracking-wide top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-red-500 px-4 py-2 rounded-xl text-white font-bold text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out">
                                        Vote
                                    </a>  
                                @endif
                            
                                
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
    @include('judge.vote.edit')
    @section('scripts')
    
        <script>
            let availablecategory = @json($eventCategory);
            let statusVote = @json(session('message'));
            $(document).ready(function(){
                
                
                // console.log(availablecategory.judge_count)

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
                    let JudgeCount = availablecategory.event.judge.length;
                    render(availablecategory.sub_category, JudgeCount)
                    $('#voteBackdrop').removeClass('hidden')
                    $('#voteModal').removeClass('hidden')
                })

                $('#voteCloseBtn').click(function(){
                    $('#voteBackdrop').addClass('hidden')
                    $('#voteModal').addClass('hidden')
                })

                //edit vote
                $('.editVote').click(function(){
                    // alert($(this).data('vote_id'))
                    $('#vote_id').val($(this).data('vote_id'))
                    $('#editCandidateName').text($(this).data('name'))
                    $('#editCategoryName').text(availablecategory.category_name)
                    let JudgeCount = availablecategory.event.judge.length;
                    edit($(this).data('vote_id'),JudgeCount)
                    $('#editBackdrop').removeClass('hidden')
                    $('#editModal').removeClass('hidden')
                })
                $('#editCloseBtn').click(function(){
                    $('#editBackdrop').addClass('hidden')
                    $('#editModal').addClass('hidden')
                })

            })

            const render = (criteria, judgeCount) => {
                let renderCriteria = ''
                criteria.forEach(c => {
                    // console.log()
                    renderCriteria += `
                        <div class="flex justify-between items-center font-bold shadow mb-2 p-2">
                            <label for="criteria">${c.sub_category}: <span>- ${c.percentage}%</span></label>
                            <input type="number" name="criteria[]" value="" min='0' max="${inputRangeScore(c.percentage,100,judgeCount)}" step="0.1" placeholder="0-${inputRangeScore(c.percentage,100,judgeCount)}" class="rounded-md" required>
                        </div>
                    `
                });

                $('#renderCriteriaContainer').html(renderCriteria)
            }

            //dynamically calculate the range input of the judge
            const inputRangeScore = (p,m,n) => {
                //maximumn total input
                const mts = p*n;
                //max judge range input
                const rs = mts/n;
                // console.log(rs)
                return rs;
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

            const edit = (id,judgeCount) => {
                let data = {id:id}
                sendRequest('GET', '{{ route('judge.edit') }}', data)
                .then(function(res){
                    // console.log()
                    let data = JSON.parse(res.vote.criteria)
                    // console.log(res)
                    let renderCriteria = ''
                    for (const key in data) {
                        if (data.hasOwnProperty(key)) {
                            const value = data[key];
                            // console.log('Key:', key, 'Value:', value);
                            availablecategory.sub_category.forEach(sc => {
                                if(key === sc.sub_category){
                                    renderCriteria += `
                                        <div class="flex justify-between items-center font-bold shadow mb-2 p-2">
                                            <label for="criteria">${key}: <span>- ${sc.percentage}%</span></label>
                                            <input type="number" name="criteria[]" value="${value}" min='0' max="${inputRangeScore(sc.percentage,100,judgeCount)}" step="0.1" placeholder="0-${inputRangeScore(sc.percentage,100,judgeCount)}" class="rounded-md" required>
                                        </div>
                                    `
                                }
                            });
                            
                        }
                    }
                    $('#renderEditCriteriaContainer').html(renderCriteria)
                    
                })
                .catch(function(err){
                    console.log(err)
                })
            }
            //dynamic request
            function sendRequest(method, url, data = {}) {
                return new Promise(function(resolve, reject) {
                    // Get the CSRF token from the meta tag
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    // Add the CSRF token to the data object
                    data._token = csrfToken;

                    $.ajax({
                        method: method,
                        url: url,
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Include CSRF token in the request headers
                        },
                        success: function(response) {
                            resolve(response);
                        },
                        error: function(xhr, status, error) {
                            reject(error);
                        }
                    });
                });
            }
        </script>
    @endsection
</x-app-layout>


