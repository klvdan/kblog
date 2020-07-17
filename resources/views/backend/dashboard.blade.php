@extends('layouts.dashboard')

@section('content')
<div class="dash-header">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                   <div class="row justify-content-center align-items-center text-center">
                        <div class="col-md-3">
                            <h2 class="card-title">1</h2>
                            <p class="card-text">{{ __('messages.article') }}</p>
                        </div>     
                        <div class="col-md-3">
                            <h2 class="card-title">1</h2>
                            <p class="card-text">{{ __('messages.tag') }}</p>
                        </div>    
                        <div class="col-md-3">
                            <h2 class="card-title">1</h2>
                            <p class="card-text">{{ __('messages.category') }}</p>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <article-chart title="{{ __('messages.article_chart_title') }}" legend="{{ __('messages.article_chart_legend') }}"></article-chart>
        </div>
    </div>
</div>
@endsection
