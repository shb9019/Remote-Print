import React from 'react';
import ReactDOM from 'react-dom';
import { PrintFiles } from './print.js';

class LoginFunction extends React.Component
{
	render()
	{
		return <h1>Hello, World</h1>;
	}
}

reactDOM.render(<PrintFiles />,document.getElementById('verdict'));
ReactDOM.render(<LoginFunction />,document.getElementById('app'));
