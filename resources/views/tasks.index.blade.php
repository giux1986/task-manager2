@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Task List') }}</div>

                <div class="card-body">
                    @foreach($tasks as $dueDate => $taskGroup)
                        <h3>{{ $dueDate }}</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Task Name') }}</th>
                                    <th scope="col">{{ __('Task Group') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($taskGroup as $task)
                                    <tr>
                                        <td>{{ $task->name }}</td>
                                        <td>{{ $task->group->name }}</td>
                                        <td>
                                            @if($task->completed_at)
                                                {{ __('Completed') }}
                                            @else
                                                {{ __('Pending') }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
