<x-layout>
    <x-breadcrumbs :links="['My Jobs' => '#']" />

    <div class="mb-8 text-right">
        <x-link-button :href="route('my-jobs.create')">Add new</x-link-button>
    </div>

    @forelse($jobs as $job)
        <x-job-card :$job>
            <div class="text-xs text-slate-500">
                @forelse($job->jobApplications as $application)
                    <div class="mb-4 flex justify-between items-center">
                        <div>
                            <div>{{ $application->user->name }}</div>
                            <div>
                                Applied {{ $application->created_at->diffForHumans() }}
                            </div>
                            <div>
                                Download CV
                            </div>
                        </div>
                        <div>${{ number_format($application->expected_salary) }}</div>
                    </div>
                @empty
                    <div>No application(s) yet.</div>
                @endforelse

                <div class="flex space-x-2">
                    <x-link-button href="{{ route('my-jobs.edit', $job) }}">Edit</x-link-button>

                    <form action="{{ route('my-jobs.destroy', $job) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button>Delete</x-button>
                    </form>
                </div>
            </div>
        </x-job-card>
    @empty
        <div class="round-md border border-dashed boder-slate-300 p-8">
            <div class="text-center font-medium">
                No jobs yet
            </div>
            <div class="text-center">
                Post your first job <a class="text-indigo-500 hover:underline" 
                    href="{{ route('my-jobs.create') }}">here!</a>
            </div>
        </div>
    @endforelse
</x-layout>