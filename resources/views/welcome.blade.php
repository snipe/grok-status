@extends('layouts.app')

@section('content')

            <!-- service groups -->
            @if (isset($servicegroups))
                @foreach ($servicegroups as $servicegroup)

                    <div class="post-preview">

                            <h4 class="post-subtitle">
                                {{ $servicegroup->name }}
                            </h4>
                            <p class="post-meta">{{ $servicegroup->description }}</p>

                            @if ($servicegroup->incidents->count() > 0)
                                @foreach ($servicegroup->incidents as $incident)

                                    <div class="alert alert alert-danger">
                                        <i class="fa fa-exclamation-circle"></i>
                                        <strong>{{ $incident->name }} </strong><br>
                                        {{ $incident->description }}
                                    </div>

                                @endforeach

                            @endif


                    </div>
                    <!-- services -->
                    @if ($servicegroup->services->count() > 0)
                        <table class="table table-striped">
                        @foreach ($servicegroup->services as $service)

                            <tr>
                                <td>
                                    {{ $service->name }}
                                </td>
                                <td>
                                    @if ($service->url!='')
                                        <a href="{{ $service->url }}">{{ $service->url }}</a>
                                    @endif
                                </td>
                                <td>
                                    {{ $service->description }}
                                </td>


                            </tr>

                        @endforeach
                        </table>
                    @endif

                @endforeach
                    <hr>
            @else
                <h3 class="post-subtitle">
                    No status information is available yet!
                </h3>
            @endif

@endsection
