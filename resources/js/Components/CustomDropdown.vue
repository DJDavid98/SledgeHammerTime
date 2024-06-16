<template>
  <details role="list">
    <summary
      aria-haspopup="listbox"
      role="button"
    >
      <slot name="trigger" />
    </summary>

    <ul role="listbox">
      <slot name="content" />
    </ul>
  </details>
</template>
