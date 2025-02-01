export const keyboardOrMouseEventHandlerFactory = (handler: (e: KeyboardEvent | MouseEvent, viaKeyboard: boolean) => void) =>
  (e: KeyboardEvent | MouseEvent) => {
    let viaKeyboard = false;
    if ('key' in e) {
      if (e.key === 'Tab' || e.key === 'Shift') {
        return;
      }
      viaKeyboard = true;
    }

    e.preventDefault();
    handler(e, viaKeyboard);
  };
