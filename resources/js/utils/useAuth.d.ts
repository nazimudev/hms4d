// useAuth.d.ts
export interface AuthComposable {
  can: (permission: string) => boolean;
  user?: any;
}

export function useAuth(): AuthComposable;
