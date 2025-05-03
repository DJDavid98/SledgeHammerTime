<script setup lang="ts">
import HtButton from '@/Reusable/HtButton.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtCode from '@/Reusable/HtCode.vue';
import HtFormControlId from '@/Reusable/HtFormControlId.vue';
import HtFormInputGroup from '@/Reusable/HtFormInputGroup.vue';
import HtInput from '@/Reusable/HtInput.vue';
import HtInputGropupText from '@/Reusable/HtInputGropupText.vue';
import HtTable from '@/Reusable/HtTable.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { getAppName } from '@/utils/app';
import { faFileExport } from '@fortawesome/free-solid-svg-icons';
import { onMounted, ref } from 'vue';

interface NumberCssVar {
  value: number;
  type: 'number';
  step?: number;
  negative?: boolean;
  unit: string;
}

interface StringCssVar {
  value: string;
  type: 'text';
}

interface ColorCssVar {
  value: string;
  type: 'color';
  alpha: number;
}

type CssVar = StringCssVar | NumberCssVar | ColorCssVar;
type NamedCssVar = CssVar & { name: string, displayName: string };

const cssVars = ref<NamedCssVar[]>([]);

const getCssVarDisplayName = (cssVar: string) =>
  cssVar
    .replace(varNamePrefix, '')
    .replace(/-bg-/g, '-background-')
    .replace(/-hl-/g, '-highlight-')
    .replace(/-cta-/g, '-call-to-action-')
    .replace(/^([a-z]+)-(.*)(-(?:light|dark))$/, '$2-$1$3')
    .replace(/(color)-color/g, '$1')
    .replace(/^value-/, '')
    .replace(/-+/g, ' ')
    .replace(/((?:^| )[a-z])/g, (m) => m.toUpperCase());

const parseCssValue = (value: string): CssVar => {
  if (value.endsWith('rem')) return { type: 'number', step: 0.0625, unit: 'rem', value: parseFloat(value) };
  if (value.endsWith('em')) return { type: 'number', step: 0.0625, unit: 'em', value: parseFloat(value) };
  if (value.endsWith('%')) return { type: 'number', step: 1, unit: '%', value: parseFloat(value) };
  if (value.endsWith('deg')) return { type: 'number', step: 1, unit: 'deg', value: parseFloat(value) };
  if (value.endsWith('px')) return { type: 'number', step: 1, unit: 'px', value: parseFloat(value) };
  if (!isNaN(parseFloat(value))) return { type: 'number', step: 0.05, unit: '', value: parseFloat(value) };
  if (/^#([\da-f]{3})$/i.test(value)) {
    return {
      type: 'color',
      value: '#' + value[1].repeat(2) + value[2].repeat(2) + value[3].repeat(2),
      alpha: 1,
    };
  }
  if (/^#([\da-f]{6})$/i.test(value)) return { type: 'color', value, alpha: 1 };
  const rgbaMatch = value.match(/^rgba?\(([\d.]+),\s*([\d.]+),\s*([\d.]+)(?:,\s*([\d.]+))?\)$/);
  if (rgbaMatch) {
    return {
      type: 'color',
      value: '#' + rgbaMatch.slice(1, 4).map(n => Math.round(parseFloat(n)).toString(16).padStart(2, '0')).join(''),
      alpha: rgbaMatch[4] ? parseFloat(rgbaMatch[4]) : 1,
    };
  }

  return { type: 'text', value }; // Default fallback
};


const exportUserStyle = () => {
  let userStyle = `
/* ${getAppName()} Custom UserStyle */
@-moz-document url-prefix("${route('root')}") {
  :root {
`;

  cssVars.value.forEach(cssVar => {
    userStyle += `    ${cssVar.name}: ${cssVar.value}${'unit' in cssVar ? cssVar.unit : ''};\n`;
  });

  userStyle += `  }
}`;

  const blob = new Blob([userStyle], { type: 'text/css' });
  const link = document.createElement('a');
  link.href = URL.createObjectURL(blob);
  link.download = `${getAppName().toLowerCase().replace(/[^a-z]+/g, '-')}.user.css`;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
};

const hex2rgb = (hex: string) => hex.replace(/^#/, '').match(/.{2}/g)?.map(digit => parseInt(digit, 16)).join(',') ?? '0,0,0';


const updateVariable = (name: string, value: string | number, unit: string = ''): void => {
  document.documentElement.style.setProperty(name, `${value}${unit}`);
};

const varNamePrefix = '--ht-';
onMounted(() => {
  const styles = getComputedStyle(document.documentElement);
  for (let i = 0; i < styles.length; i++) {
    const varName = styles[i];
    if (varName && varName.startsWith(varNamePrefix)) {
      const value = styles.getPropertyValue(varName).trim();
      const parsed = parseCssValue(value);
      if (parsed.type === 'number') {
        parsed.negative = parsed.value < 0;
      }
      const cssVar: NamedCssVar = { ...parsed, name: varName, displayName: getCssVarDisplayName(varName) };
      cssVars.value.push(cssVar);
    }
  }
  cssVars.value.sort((a, b) => a.displayName.localeCompare(b.displayName));
});
</script>

<template>
  <HtCard class="design-editor">
    <template #header>
      <h2>{{ $t('global.designEditor.title') }}</h2>
    </template>

    <p class="mb-3">
      {{ $t('global.designEditor.description') }}
    </p>

    <p class="mb-3">
      <HtTranslate i18n-key="global.designEditor.exportInfo">
        <template #1="slotProps">
          <a
            href="https://github.com/openstyles/stylus"
            rel="noopener noreferrer"
            target="_blank"
          >
            {{ slotProps.text }}
          </a>
        </template>
      </HtTranslate>
    </p>

    <HtButton
      color="primary"
      :icon-start="faFileExport"
      @click="exportUserStyle"
    >
      {{ $t('global.designEditor.export') }}
    </HtButton>

    <HtTable
      class="design-editor-table mt-3"
      :responsive="true"
    >
      <thead>
        <tr>
          <th>{{ $t('global.designEditor.variableColumnHeader') }}</th>
          <th>{{ $t('global.designEditor.valueColumnHeader') }}</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="cssVar in cssVars"
          :key="cssVar.name"
        >
          <td>
            <label :for="cssVar.name">
              {{ cssVar.displayName }}
            </label>
            <br>
            <HtCode :small="true">
              {{ cssVar.name }}
            </HtCode>
          </td>
          <td>
            <HtFormInputGroup
              v-if="cssVar.type === 'color'"
              :id="cssVar.name"
              dir="ltr"
            >
              <HtInput
                v-model="cssVar.value"
                type="color"
                @input="updateVariable(cssVar.name, cssVar.value)"
              />
              <template v-if="'alpha' in cssVar && typeof cssVar.alpha !== 'undefined'">
                <HtInputGropupText align="right">
                  &alpha;:
                </HtInputGropupText>
                <HtInput
                  v-model="cssVar.alpha"
                  type="number"
                  min="0"
                  max="1"
                  step="0.1"
                  @input="updateVariable(cssVar.name, cssVar.alpha === 1 ? cssVar.value : `rgba(${hex2rgb(cssVar.value)},${cssVar.alpha})`)"
                />
              </template>
            </HtFormInputGroup>
            <HtFormInputGroup
              v-else-if="cssVar.type === 'number'"
              :id="cssVar.name"
              dir="ltr"
            >
              <HtInput
                v-model="cssVar.value"
                type="number"
                :step="cssVar.step"
                :min="cssVar.negative ? undefined : 0"
                :max="cssVar.negative ? 0 : undefined"
                @input="updateVariable(cssVar.name, cssVar.value, cssVar.unit)"
              />
              <HtInputGropupText v-if="'unit' in cssVar && cssVar.unit.length > 0">
                {{ cssVar.unit }}
              </HtInputGropupText>
            </HtFormInputGroup>
            <HtFormControlId
              v-else
              :id="cssVar.name"
            >
              <HtInput
                v-model="cssVar.value"
                type="text"
                @input="updateVariable(cssVar.name, cssVar.value)"
              />
            </HtFormControlId>
          </td>
        </tr>
      </tbody>
    </HtTable>
  </HtCard>
</template>
