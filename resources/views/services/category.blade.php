@extends('layouts.app')

@section('content')

    <div class="page-single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <!-- Post Single Content Start -->

                    @if(!empty($category->description))
                        <div class="post-content">
                            <div class="post-entry">
                                {!! $category->description !!}
                            </div>
                        </div>
                    @endif

                    <!-- Services List -->
                    @if($services->isNotEmpty())
                        <div class="our-amenities-prime bg-section" style="margin-top: 4rem;">
                            <div class="container">
                                <div class="row section-row">
                                    <div class="col-lg-12">
                                        <!-- Section Title Start -->
                                        <div class="section-title">
                                            <span class="section-sub-title wow fadeInUp fs-6">Наши услуги</span>
                                            <h2 class="text-anime-style-3" data-cursor="-opaque">Услуги в категории «{{ $category->title }}»</h2>
                                        </div>
                                        <!-- Section Title End -->
                                    </div>
                                </div>

                                <div class="row">
                                    @foreach($services as $service)
                                        <div class="col-xl-4 col-md-6">
                                            <div class="amenity-item-prime wow fadeInUp">

                                                <div class="amenity-item-body-prime">

                                                    <div class="amenity-item-content-prime">
                                                        <h2>
                                                            <a href="{{ route('services.show', $service->slug) }}">
                                                                {{ $service->title }}
                                                            </a>
                                                        </h2>
                                                        <p>{{ $service->excerpt }}</p>
                                                    </div>

                                                    <div class="amenity-item-footer-prime">
                                                        <div class="hero-content-btn wow fadeInUp" data-wow-delay="0.4s">
                                                            <a href="{{ route('services.show', $service->slug) }}" class="btn-default btn-highlighted">
                                                                подробнее
                                                            </a>

                                                            @if($service->category?->projectCategory)
                                                                <a href="{{ route('projects.category', $service->category->projectCategory->slug) }}" class="btn-default">
                                                                    проекты
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Universal Calculator Section -->
                    @if($category->calculator_enabled && !empty($category->calculator_fields))
                        <div class="our-amenities-prime bg-section calculator-section" style="margin-top: 4rem;">
                            <div class="container">
                                <div class="row section-row">
                                    <div class="col-lg-12">
                                        <div class="section-title">
                                            <span class="section-sub-title wow fadeInUp fs-6">Калькулятор</span>
                                            <h2 class="text-anime-style-3" data-cursor="-opaque">
                                                {{ $category->calculator_title ?? 'Калькулятор стоимости услуг' }}
                                            </h2>
                                            @if($category->calculator_description)
                                                <div class="calculator-description mt-3">
                                                    {!! $category->calculator_description !!}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="calculator-container">
                                            <form id="universal-calculator" class="calculator-form">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        @foreach($category->calculator_fields as $fieldIndex => $field)
                                                            <div class="calculator-field mb-3">
                                                                <label for="calc-field-{{ $fieldIndex }}" class="form-label">
                                                                    {{ $field['label'] ?? '' }}
                                                                </label>
                                                                
                                                                @php
                                                                    $fieldKey = $field['key'] ?? 'field_' . $fieldIndex;
                                                                    $fieldType = $field['type'] ?? 'number';
                                                                    $defaultValue = $field['default_value'] ?? '';
                                                                    $placeholder = $field['placeholder'] ?? '';
                                                                    $min = $field['min'] ?? '';
                                                                    $max = $field['max'] ?? '';
                                                                    $step = $field['step'] ?? '';
                                                                    $options = $field['options'] ?? [];
                                                                @endphp

                                                                @if($fieldType === 'select' || $fieldType === 'radio')
                                                                    @foreach($options as $optionIndex => $option)
                                                                        @php
                                                                            $optionKey = $fieldKey . '_' . $optionIndex;
                                                                            $optionValue = $option['value'] ?? '';
                                                                            $optionLabel = $option['label'] ?? '';
                                                                            $isFirst = $loop->first;
                                                                        @endphp
                                                                        
                                                                        @if($fieldType === 'radio')
                                                                            <div class="form-check">
                                                                                <input class="form-check-input calculator-input" 
                                                                                       type="radio" 
                                                                                       name="{{ $fieldKey }}" 
                                                                                       id="{{ $optionKey }}" 
                                                                                       value="{{ $optionValue }}"
                                                                                       data-field-key="{{ $fieldKey }}"
                                                                                       {{ $isFirst ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="{{ $optionKey }}">
                                                                                    {{ $optionLabel }}
                                                                                </label>
                                                                            </div>
                                                                        @else
                                                                            <select class="form-select calculator-input" 
                                                                                    id="calc-field-{{ $fieldIndex }}" 
                                                                                    name="{{ $fieldKey }}"
                                                                                    data-field-key="{{ $fieldKey }}">
                                                                                <option value="">Выберите...</option>
                                                                                <option value="{{ $optionValue }}" {{ $isFirst ? 'selected' : '' }}>
                                                                                    {{ $optionLabel }}
                                                                                </option>
                                                                            </select>
                                                                        @endif
                                                                    @endforeach
                                                                @elseif($fieldType === 'checkbox')
                                                                    <div class="form-check">
                                                                        <input class="form-check-input calculator-input" 
                                                                               type="checkbox" 
                                                                               id="calc-field-{{ $fieldIndex }}" 
                                                                               name="{{ $fieldKey }}" 
                                                                               value="1"
                                                                               data-field-key="{{ $fieldKey }}"
                                                                               {{ $defaultValue ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="calc-field-{{ $fieldIndex }}">
                                                                            {{ $field['checkbox_label'] ?? $field['label'] ?? '' }}
                                                                        </label>
                                                                    </div>
                                                                @elseif($fieldType === 'range')
                                                                    <div class="range-slider-wrapper">
                                                                        <input type="range" 
                                                                               class="form-range calculator-input" 
                                                                               id="calc-field-{{ $fieldIndex }}" 
                                                                               name="{{ $fieldKey }}"
                                                                               data-field-key="{{ $fieldKey }}"
                                                                               min="{{ $min }}" 
                                                                               max="{{ $max }}" 
                                                                               step="{{ $step }}" 
                                                                               value="{{ $defaultValue }}">
                                                                        <div class="range-value-display">
                                                                            <span class="range-value">{{ $defaultValue }}</span>
                                                                            <span class="range-unit">{{ $field['unit'] ?? '' }}</span>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <input type="{{ $fieldType }}" 
                                                                           class="form-control calculator-input" 
                                                                           id="calc-field-{{ $fieldIndex }}" 
                                                                           name="{{ $fieldKey }}"
                                                                           data-field-key="{{ $fieldKey }}"
                                                                           placeholder="{{ $placeholder }}"
                                                                           value="{{ $defaultValue }}"
                                                                           @if($min !== '') min="{{ $min }}" @endif
                                                                           @if($max !== '') max="{{ $max }}" @endif
                                                                           @if($step !== '') step="{{ $step }}" @endif>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <div class="calculator-result">
                                                            <div class="result-display">
                                                                <div class="result-label">
                                                                    {{ $category->calculator_result_label ?? 'Итоговая стоимость' }}
                                                                </div>
                                                                <div class="result-value">
                                                                    <span id="calculator-total">0</span>
                                                                    <span class="currency">{{ $category->calculator_currency ?? 'BYN' }}</span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="calculator-actions mt-3">
                                                                <button type="button" class="btn btn-primary" onclick="calculateResult()">
                                                                    Пересчитать
                                                                </button>
                                                                <button type="button" class="btn btn-outline-secondary" onclick="resetCalculator()">
                                                                    Сбросить
                                                                </button>
                                                            </div>
                                                            
                                                            @if($category->calculator_formula)
                                                                <div class="formula-display mt-3">
                                                                    <small class="text-muted">
                                                                        Формула: {{ $category->calculator_formula }}
                                                                    </small>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @php
                        $faqs = [];

                        if(!empty($category->faq)) {
                            $faqs = json_decode($category->faq, true) ?: [];
                        } elseif(!empty($subcategory->faq)) {
                            $faqs = json_decode($subcategory->faq, true) ?: [];
                        }
                    @endphp

                    @if(!empty($faqs))
                        <div class="page-single-faqs">
                            <div class="section-title">
                                <h2 class="text-anime-style-3" data-cursor="-opaque">Популярные вопросы и ответы</h2>
                            </div>
                            <div class="faq-accordion" id="accordion">
                                @foreach($faqs as $index => $item)
                                    @php
                                        $collapseId = 'collapse' . $index;
                                        $headingId = 'heading' . $index;
                                    @endphp
                                    <div class="accordion-item wow fadeInUp">
                                        <h2 class="accordion-header" id="{{ $headingId }}">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#{{ $collapseId }}"
                                                    aria-expanded="false"
                                                    aria-controls="{{ $collapseId }}">
                                                {{ $item['question'] ?? '' }}
                                            </button>
                                        </h2>
                                        <div id="{{ $collapseId }}" class="accordion-collapse collapse" role="region" aria-labelledby="{{ $headingId }}" data-bs-parent="#accordion">
                                            <div class="accordion-body">
                                                <p>{!! $item['answer'] ?? '' !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>



@endsection

@push('scripts')
@if($category->calculator_enabled && !empty($category->calculator_fields))
<script>
    // Calculator configuration from server
    const calculatorConfig = {
        formula: '{{ $category->calculator_formula ?? "" }}',
        currency: '{{ $category->calculator_currency ?? "BYN" }}',
        fields: @json($category->calculator_fields ?? [])
    };

    // Get all calculator input elements
    function getCalculatorInputs() {
        return document.querySelectorAll('.calculator-input');
    }

    // Calculate the result based on formula and input values
    function calculateResult() {
        const inputs = getCalculatorInputs();
        const values = {};
        
        // Collect all field values
        inputs.forEach(input => {
            const fieldKey = input.dataset.fieldKey || input.name;
            let value;
            
            if (input.type === 'checkbox') {
                value = input.checked ? 1 : 0;
            } else if (input.type === 'radio') {
                if (input.checked) {
                    value = parseFloat(input.value) || 0;
                } else {
                    return; // Skip unchecked radio buttons
                }
            } else {
                value = parseFloat(input.value) || 0;
            }
            
            values[fieldKey] = value;
        });

        // Replace formula placeholders with actual values
        let formula = calculatorConfig.formula || '';
        
        // If no formula, calculate as sum of all field values multiplied
        if (!formula && Object.keys(values).length > 0) {
            // Default: multiply all values
            formula = Object.keys(values).map(key => `{${key}}`).join(' * ');
        }

        // Replace placeholders with values
        Object.keys(values).forEach(key => {
            const placeholder = `{${key}}`;
            formula = formula.replace(new RegExp(placeholder, 'g'), values[key]);
        });

        // Calculate the result using JavaScript eval (for simple math expressions)
        let result = 0;
        try {
            // Sanitize: only allow numbers, operators, parentheses, and spaces
            const sanitizedFormula = formula.replace(/[^0-9+\-*/().\s]/g, '');
            if (sanitizedFormula) {
                result = Function('"use strict";return (' + sanitizedFormula + ')')();
            }
        } catch (e) {
            console.error('Calculation error:', e);
            result = 0;
        }

        // Format and display result
        const totalElement = document.getElementById('calculator-total');
        if (totalElement) {
            totalElement.textContent = result.toLocaleString('ru-RU', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 2
            });
        }

        return result;
    }

    // Reset calculator to default values
    function resetCalculator() {
        const inputs = getCalculatorInputs();
        
        inputs.forEach((input, index) => {
            const fieldConfig = calculatorConfig.fields[index];
            
            if (input.type === 'checkbox') {
                input.checked = fieldConfig?.default_value ? true : false;
            } else if (input.type === 'radio') {
                // Reset to first option
                const firstRadio = document.querySelector(`input[name="${input.name}"]`);
                if (firstRadio) firstRadio.checked = true;
            } else if (input.tagName === 'SELECT') {
                const firstOption = input.querySelector('option:not([value=""])');
                if (firstOption) firstOption.selected = true;
            } else {
                input.value = fieldConfig?.default_value || '';
            }
            
            // Update range display if applicable
            if (input.type === 'range') {
                const display = input.parentElement.querySelector('.range-value');
                if (display) {
                    display.textContent = input.value;
                }
            }
        });

        calculateResult();
    }

    // Initialize calculator on page load
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = getCalculatorInputs();
        
        // Add event listeners to all inputs
        inputs.forEach(input => {
            // For range sliders, update display value
            if (input.type === 'range') {
                input.addEventListener('input', function() {
                    const display = this.parentElement.querySelector('.range-value');
                    if (display) {
                        display.textContent = this.value;
                    }
                    calculateResult();
                });
            }
            
            // Add change/input listeners for real-time calculation
            input.addEventListener('change', calculateResult);
            if (input.type !== 'range') {
                input.addEventListener('input', calculateResult);
            }
        });

        // Initial calculation
        calculateResult();
    });
</script>
@endif
@endpush
