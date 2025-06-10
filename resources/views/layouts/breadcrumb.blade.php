<!-- Breadcrumb Component -->
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
      <div class="col-md-12">
        <ul class="breadcrumb">
          @foreach ($breadcrumbs as $crumb)
            @if (!$loop->last)
              <li class="breadcrumb-item">
                @if (!$crumb['active'])
                  <a href="{{ $crumb['url'] ?? 'javascript:void(0)' }}">{{ $crumb['label'] }}</a>
                @else
                  {{ $crumb['label'] }}
                @endif
              </li>
            @else
              <li class="breadcrumb-item active" aria-current="page">{{ $crumb['label'] }}</li>
            @endif
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
