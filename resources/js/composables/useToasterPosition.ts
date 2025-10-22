import { ref } from 'vue'

const position = ref<'top-left' | 'top-right' | 'bottom-left' | 'bottom-right'| 'center'>('top-right')

export function useToasterPosition() {
  function setPosition(newPos: typeof position.value) {
    position.value = newPos
  }

  return { position, setPosition }
}
