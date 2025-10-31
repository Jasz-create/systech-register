<x-layouts.app :title="'Registro SYSTECH'">
  <h1>Registro SYSTECH</h1>

  @if(session('ok')) <div class="alert ok">{{ session('ok') }}</div>@endif
  @if($errors->any())
    <div class="alert err">
      <strong>Revisa:</strong>
      <ul>
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
      </ul>
    </div>
  @endif

  <form method="post" action="{{ route('register.store') }}">
    @csrf
    <div class="row">
      <div>
        <label>Nombre completo</label>
        <input name="full_name" value="{{ old('full_name') }}" required>
      </div>
      <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
      </div>
      <div>
        <label>CIF</label>
        <input name="cif" value="{{ old('cif') }}" required>
      </div>
      <div>
        <label>Talla de camisa</label>
        <select name="shirt_size" required>
          @foreach(['XS','S','M','L','XL','XXL'] as $t)
            <option value="{{ $t }}" @selected(old('shirt_size')===$t)>{{ $t }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label>Número de recibo</label>
        <input name="receipt_number" value="{{ old('receipt_number') }}" required>
      </div>
      <div>
        <label>Monto (opcional)</label>
        <input type="number" step="0.01" name="amount" value="{{ old('amount') }}">
      </div>
      <div>
        <label>Fecha de pago (opcional)</label>
        <input type="date" name="paid_at" value="{{ old('paid_at') }}">
      </div>
    </div>
    <br>
    <button class="btn">Guardar registro</button>
  </form>

  <p style="margin-top:14px;">
    <a class="btn" href="{{ route('bad.form') }}">(DEMO) Versión con anti-patrones</a>
  </p>
</x-layouts.app>
