<label class="flex items-center gap-3 bg-white border rounded-xl p-4 mb-3">
  <input type="checkbox" name="symptoms[]" value="{{ $symptom->code }}">

  <div>
    <p>{{ $symptom->name }}</p>
    <p class="text-xs text-gray-500">{{ $symptom->code }}</p>
  </div>
</label>
