import React from 'react';
import ReactDOM from 'react-dom';
import { PrintFiles } from './print.jsx';

class LoginFunction extends React.Component
{
	render()
	{
		return <div></div>;
	}
}

ReactDOM.render(<PrintFiles />,document.getElementById('drop'));
ReactDOM.render(<LoginFunction />,document.getElementById('app'));
