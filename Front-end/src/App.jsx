import React from 'react';
import Button from './components/Button';

function App() {
  return (
    <div className="container mx-auto p-4">
      <h1 className="text-2xl font-bold mb-4">HACK-GO</h1>

      <div className="flex flex-col gap-4 md:flex-row">
        <Button>Default Button</Button>
        <Button variant="secondary">Secondary Button</Button>
        <Button variant="outline">Outline Button</Button>
        <Button variant="destructive">Destructive Button</Button>
      </div>

      <div className="mt-4 flex flex-col gap-4 md:flex-row">
        <Button size="small">Small Button</Button>
        <Button>Medium Button</Button>
        <Button size="large">Large Button</Button>
      </div>

      {/* Your existing content */}
    </div>
  );
}

export default App;
