<x-layouts.app :title="'Registro SYSTECH'">
  <h1>Registro SYSTECH</h1>

  @if(session('ok')) <div class="alert ok">{{ session('ok') }}</div>@endif
  @if($errors->any())
    <div class="alert err">
      <strong>Revisa:</strong>
      <ul>
        @foreach($errors->all() as $e)
          <li>{{ is_array($e) ? implode(', ',$e) : $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="post" action="{{ route('register.store') }}">
    @csrf
    <div class="row">
      <div>
        <label>Nombre *</label>
        <input name="first_name" value="{{ old('first_name') }}" required placeholder="First">
      </div>
      <div>
        <label>&nbsp;</label>
        <input name="last_name" value="{{ old('last_name') }}" required placeholder="Last">
      </div>

      <div>
        <label>Número de Recibo *</label>
        <input name="receipt_number" value="{{ old('receipt_number') }}" required>
      </div>

      <div>
        <label>Email *</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
      </div>

      <div>
        <label>Carrera *</label>
        <select name="career" required>
          @php
            $careers = [
              'Ingeniería en Sistemas',
              'Ingeniería Industrial',
              'Arquitectura',
              'Administración de Empresas',
              'Contaduría y Finanzas',
              'Derecho',
              'Medicina',
            ];
          @endphp
          @foreach($careers as $c)
            <option value="{{ $c }}" @selected(old('career')===$c)>{{ $c }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label>Talla de Camisa *</label>
        <select name="shirt_size" required>
          @foreach(['XS','S','M','L','XL','XXL'] as $t)
            <option value="{{ $t }}" @selected(old('shirt_size')===$t)>{{ $t }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label>Año Lectivo *</label>
        <select name="academic_year" required>
          @for($i=1;$i<=5;$i++)
            <option value="{{ $i }}" @selected(old('academic_year')==$i)>{{ $i }}</option>
          @endfor
        </select>
      </div>

      <div>
        <label>Fecha de pago (opcional)</label>
        <input type="date" name="paid_at" value="{{ old('paid_at') }}">
      </div>
    </div>

    <br>

    <div style="display:flex; gap:10px; flex-wrap:wrap;">
      <button class="btn" type="submit">Registrarse</button>

      {{-- Botón a la versión con anti-patrones (demo) --}}
      <a class="btn" href="{{ route('bad.form') }}">(DEMO) Versión anti-patrones</a>
    </div>
  </form>
</x-layouts.app>
