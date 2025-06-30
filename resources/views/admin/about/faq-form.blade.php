@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ isset($faq) ? 'Edit' : 'Add New' }} FAQ</h3>
    </div>
    <form action="{{ isset($faq) ? route('admin.about.faq.update', $faq->id) : route('admin.about.faq.store') }}" method="POST">
        @csrf
        @if(isset($faq)) @method('PUT') @endif
        
        <div class="card-body">
            <div class="form-group">
                <label for="question">Question</label>
                <input type="text" name="question" id="question" 
                       class="form-control @error('question') is-invalid @enderror" 
                       value="{{ old('question', $faq->question ?? '') }}" required>
                @error('question')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="answer">Answer</label>
                <textarea name="answer" id="answer" rows="5" 
                          class="form-control @error('answer') is-invalid @enderror" 
                          required>{{ old('answer', $faq->answer ?? '') }}</textarea>
                @error('answer')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="order">Display Order</label>
                <input type="number" name="order" id="order" 
                       class="form-control @error('order') is-invalid @enderror" 
                       value="{{ old('order', $faq->order ?? 0) }}">
                @error('order')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save
            </button>
            <a href="{{ route('admin.about.faq-index') }}" class="btn btn-default">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        // Initialize any JS plugins if needed
        // Example: Summernote for rich text editing
        // $('#answer').summernote();
    });
</script>
@endsection