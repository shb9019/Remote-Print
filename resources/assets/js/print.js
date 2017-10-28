import React from 'react';
import ReactDOM from 'react-dom';
var axios = require('axios');

export class PrintFiles extends React.Component
{
	constructor(props) {
		super(props);
		this.state = {files: []};
	}

	getFiles(e) 
	{
		e.preventDefault();

		let reader = new FileReader();
		let files = e.target.files;

		console.log(files);
		/*reader.onloadend () => {
			this.setState({
				files: files
			});
		}*/ 
	}
	sendFiles()
	{

	}

	render()
	{
		return (
			<div>
				<form onSubmit = {this.sendFiles} >
					<input type="file" name="print_files" onChange = {this.getFiles} multiple></input>
					<input type="submit"></input>
				</form>	 
			</div>
		);
	}
}