import React from 'react';
import ReactDOM from 'react-dom';

class LoginFunction extends React.Component
{
	render()
	{
		return <h1>Hello, World</h1>;
	}
}

ReactDOM.render(<LoginFunction />,document.getElementById('app'));
