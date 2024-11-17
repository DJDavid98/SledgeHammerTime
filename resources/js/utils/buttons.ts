export type ButtonColors = 'primary' | 'success' | 'danger';

export interface GetButtonClassesOptions {
  'class'?: string | Record<string, boolean>,
  color?: ButtonColors,
  block?: boolean;
  pressed?: boolean;
  iconOnly?: boolean;
  justifyCenter?: boolean;
}

export const getButtonClasses = (props: GetButtonClassesOptions) => {
  return ['button', props.class, {
    [`color-${props.color}`]: props.color,
    block: props.block,
    pressed: props.pressed,
    'icon-only': props.iconOnly,
    'justify-center': props.justifyCenter,
  }];
};
